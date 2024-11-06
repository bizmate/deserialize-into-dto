# Serialize Collection to Array

Run project with `make up` and go to http://localhost:8080/docs#
Also run `make logs_tail` to see logs or

Running the Get (just specify any value for name) for Dto resource returns

```json
{
  "@context": "/contexts/Dto",
  "@id": "/dtos/1",
  "@type": "Dto",
  "id": 1,
  "sourceConfigs": [
    {
      "@type": "SourceConfig",
      "@id": "/.well-known/genid/cbe874369d331cb7f54c",
      "siteId": "aSiteId"
    },
    {
      "@type": "SourceConfig",
      "@id": "/.well-known/genid/c8c4e4437c1bc2f7953c",
      "siteId": "aSiteId2"
    },
    {
      "@type": "SourceConfig",
      "@id": "/.well-known/genid/038d1c72bbc86d922a3c",
      "siteId": "aSiteId3"
    }
  ],
  "name": "name"
}
```

However, if you want to send the entity back and handle it in a custom controller where serializer can denormalize it 
back to the Dto you can run ... 

```json
curl -X 'POST'   'http://localhost:8080/deserialize'   -d '{
  "name": "pippino",
  "sourceConfigs": [
    {
      "siteId": "aSiteId"
    },
    {
      "siteId": "aSiteId2"
    },
    {
      "siteId": "aSiteId3"
    }
  ]
}'

```

And the collection is not denormalised back into the Dto as error 

`Could not denormalize object of type Doctrine\Common\Collections\Collection`

and in the logs 

```
 request.CRITICAL: Uncaught PHP Exception Symfony\Component\Serializer\Exception\NotNormalizableValueException: "Could not denormalize object of type "Doctrine\Common\Collections\Collection", no supporting normalizer found." at Serializer.php line 220 {"exception":"[object] (Symfony\\Component\\Serializer\\Exception\\NotNormalizableValueException(code: 0): Could not denormalize object of type \"Doctrine\\Common\\Collections\\Collection\", no supporting normalizer found. at /app/vendor/symfony/serializer/Serializer.php:220)"} []
```

The same if you send a post through the API platform as the build in mechanism fails the same way
