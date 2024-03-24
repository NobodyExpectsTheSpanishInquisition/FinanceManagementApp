package transport

import (
	"fmt"
	"github.com/rabbitmq/amqp091-go"
	"main/logger"
)

type eventBinding struct {
	event    string
	listener func()
}

type IConsumer interface {
	Consume() error
	RegisterListeners([]eventBinding)
	CloseConnection() error
}

type amqpConsumer struct {
	dsn        string
	connection *amqp091.Connection
	channel    *amqp091.Channel
	queues     []amqp091.Queue
	bindings   []eventBinding
}

func (c *amqpConsumer) CloseConnection() error {
	var err error

	if nil != c.channel {
		err = c.channel.Close()
		if nil != err {
			return newAmqpTransportError(fmt.Sprintf(CannotCloseChannelWithReasonMessage, err.Error()))
		}
	}

	if nil != c.connection {
		err = c.connection.Close()
		if nil != err {
			return newAmqpTransportError(fmt.Sprintf(CannotCloseConnectionWithReasonMessage, err.Error()))
		}
	}

	return nil
}

func newAmqpConsumer(dsn string) *amqpConsumer {
	return &amqpConsumer{dsn: dsn}
}

func (c *amqpConsumer) Consume() error {
	if c.channel == nil {
		return newAmqpTransportError(CannotConsumeBecauseChannelIsNotInitialized)
	}

	for _, queue := range c.queues {
		messages, err := c.channel.Consume(queue.Name, "", false, false, false, false, nil)
		if err != nil {
			return err
		}

		go func() {
			for d := range messages {
				logger.LogInfo(fmt.Sprintf("Received a message: %s", d.Body))
			}
		}()

		logger.LogInfo("[*] Waiting for messages. To exit press CTRL+C")
	}

	return nil
}

func (c *amqpConsumer) RegisterListeners(bindings []eventBinding) {
	c.bindings = bindings
}

func (c *amqpConsumer) connect(queues [1]string) error {
	connection, err := amqp091.Dial(c.dsn)
	if err != nil {
		return newAmqpTransportError(IncorrectDsnMessage)
	}
	c.connection = connection

	channel, err := connection.Channel()
	if err != nil {
		return err
	}
	c.channel = channel

	for _, queueName := range queues {
		queue, err := channel.QueueDeclare(queueName, false, false, false, false, nil)
		if err != nil {
			return err
		}
		c.queues = append(c.queues, queue)
	}

	return nil
}

func CreateConsumer(dsn string, queues [1]string) (IConsumer, error) {
	consumer := newAmqpConsumer(dsn)
	if err := consumer.connect(queues); err != nil {
		return nil, err
	}
	return consumer, nil
}
