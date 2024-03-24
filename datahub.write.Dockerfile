ARG IMAGE_TAG
FROM golang:${IMAGE_TAG}

WORKDIR /src

# Download Go modules
COPY ./datahub/write/go.mod /src/go.mod
COPY ./datahub/write/go.sum /src/go.sum
COPY ./datahub/write/.env /src/.env
COPY ./datahub/write /src/

RUN go mod tidy
RUN go mod download
RUN CGO_ENABLED=0 GOOS=linux go build -o /bin/app
RUN chmod +x /bin/app

CMD ["/bin/app"]