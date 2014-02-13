Behancer
========

Statamic plugin using Behance API to pull in project data

## Usage:

All of the Behance project data is turned into YAML that is accessible in your templates. If you want to pull in your project's hi-res images, pass the plugin your projects ID and use the following code:

```
{{ behancer id="{{ project_id }}" }}
  {{ modules }}
    {{ sizes }}
      <img src="{{ max_1240 }}" width="1240">
    {{ /sizes }}
  {{ /modules }}
{{ /behancer }}
```
