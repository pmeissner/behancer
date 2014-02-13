Behancer for Statamic by (http://lou.pe)[Philip Meissner]
=========================================================

Statamic plugin using Behance API to pull in project data.

## Usage:

1. (https://www.behance.net/dev)[Register] your Behance app.
2. Place you Client ID and Client Secret in the `_config/bundles/behancer/behancer.yaml` file.
3. Pass the plugin your project id. All of the Behance project data is turned into YAML that is accessible in your templates. If you want to pull in your project's hi-res images, use the following code:

```
{{ behancer id="{{ project_id }}" }}
  {{ modules }}
    {{ sizes }}
      <img src="{{ max_1240 }}" width="1240">
    {{ /sizes }}
  {{ /modules }}
{{ /behancer }}
```

### Notes

The plugin caches the data once a day so you shouldn't hit Behance's API request limits of 150 per hour. Unfortunantly, if you edit a Behance projects you will have to wait 24 hours to see the change on your site, or wipe out your cache if you are impatient. 
