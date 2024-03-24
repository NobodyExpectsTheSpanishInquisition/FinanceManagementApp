package environment

import (
	"github.com/joho/godotenv"
	"os"
)

const AmqpDsn = "AMQP_TRANSPORT_DSN"
const EventsQueueName = "AMQP_TRANSPORT_QUEUE_EVENTS"

func LoadEnv() error {
	return godotenv.Load("/src/.env")
}

func GetEnvVariable(key string) string {
	return os.Getenv(key)
}
