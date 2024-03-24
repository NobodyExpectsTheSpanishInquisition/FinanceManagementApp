package transport

import (
	"errors"
	"testing"
)

func TestCreateConsumerShouldReturnErrorWhenIncorrectDSNProvided(t *testing.T) {
	_, err := CreateConsumer("IncorrectDSN", [1]string{"test_queue"})

	assertErrorWasReturned(err, t)
	assertErrorIsInstanceOfAmqpTransportError(err, t)
	assertErrorMessage(err, IncorrectDsnMessage, t)
}

func TestConsumeShouldReturnErrorWhenThereIsNoOpenChannel(t *testing.T) {
	consumer := amqpConsumer{}

	err := consumer.Consume()

	assertErrorWasReturned(err, t)
	assertErrorIsInstanceOfAmqpTransportError(err, t)
	assertErrorMessage(err, CannotConsumeBecauseChannelIsNotInitialized, t)
}

func assertErrorIsInstanceOfAmqpTransportError(err error, t *testing.T) {
	var amqpTransportError amqpTransportError
	ok := errors.As(err, &amqpTransportError)
	if false == ok {
		t.Fail()
	}
}

func assertErrorWasReturned(err error, t *testing.T) {
	if nil == err {
		t.Fail()
	}
}

func assertErrorMessage(err error, expectedErrorMessage string, t *testing.T) {
	if expectedErrorMessage != err.Error() {
		t.Fail()
	}
}
