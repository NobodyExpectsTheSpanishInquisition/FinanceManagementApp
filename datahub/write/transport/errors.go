package transport

const IncorrectDsnMessage = "Cannot connect to amqp client. Invalid DSN."
const CannotConnectWithReasonMessage = "Cannot connect to amqp client. Reason: %s"
const CannotCloseChannelWithReasonMessage = "Cannot close channel. Reason: %s"
const CannotCloseConnectionWithReasonMessage = "Cannot close connection. Reason: %s"
const CannotConsumeBecauseChannelIsNotInitialized = "Cannot consume messages. Channel is not initialized."

type amqpTransportError struct {
	message string
}

func newAmqpTransportError(message string) amqpTransportError {
	return amqpTransportError{message: message}
}

func (err amqpTransportError) Error() string {
	return err.message
}
