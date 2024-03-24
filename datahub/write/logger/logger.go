package logger

import "github.com/sirupsen/logrus"

func ConfigureLogger() {
	logrus.SetFormatter(&logrus.TextFormatter{})
}

func LogError(message string) {
	logrus.Error(message)
}

func LogFatal(message string) {
	logrus.Fatal(message)
}

func LogInfo(message string) {
	logrus.Info(message)
}
