FROM alpine:3.7
LABEL maintainer="hltree"

ARG builddate
ENV BUILDDATE=${builddate}

ENV BUILDFROM="from Alpine"
ENTRYPOINT ["/bin/ash", "-c"]
CMD ["env"]
