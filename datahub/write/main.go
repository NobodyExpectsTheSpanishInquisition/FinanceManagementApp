package main

import (
	"main/environment"
	"main/logger"
	"main/transport"
)

func main() {
	var err error = nil
	err = configureApplication()

	if err != nil {
		logger.LogFatal(err.Error())
		return
	}

	var consumer transport.IConsumer

	consumer, err = transport.CreateConsumer(environment.GetEnvVariable(environment.AmqpDsn), [1]string{environment.GetEnvVariable(environment.EventsQueueName)})
	if err != nil {
		logger.LogFatal(err.Error())
		return
	}

	var forever chan struct{}

	err = consumer.Consume()
	if err != nil {
		logger.LogFatal(err.Error())
		return
	}

	<-forever
}

func configureApplication() error {
	err := environment.LoadEnv()
	if nil != err {
		return err
	}
	logger.ConfigureLogger()

	return err
}
