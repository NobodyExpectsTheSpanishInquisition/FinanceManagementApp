ARG IMAGE_TAG
FROM golang:${IMAGE_TAG}

WORKDIR /src

COPY ./datahub/write/go.mod /src/go.mod
COPY ./datahub/write/go.sum /src/go.sum
COPY ./datahub/write/.env /src/.env
COPY ./datahub/write /src/

RUN go mod tidy
RUN go mod download

RUN go test ./... -v || exit 1
