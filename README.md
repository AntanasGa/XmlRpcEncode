XmlRpcEncode
============

Easy way to encode XMLRPC calls

## Documentation

### Table of Contents
 * [Usage](#Usage)
  * [As Request](#As-Request)
  * [As Response](#As-Response)
  * [As Error Message](#As-Error)
### Installation
installing using composer:
`composer.json`:
```json
"require": {
    "antanasga/xmlrpcencode": "^0.1.2"
}
```

In terminal:

```
$ composer require antanasga/xmlrpcencode
```

### Notes
* The only parced object is `DateTime`
* When specific type is required use `([type name])`
  * Example: `(float) 1`, returns `<double>1.000000</double>`. Keep in mind `float` fits XMLRPC spec as `double`

[Back To top](#Documentation)

### Usage

#### As request

Request:
```php
$e = new Encode(
    [
        'hello-world',
        [
            "int" => 1,
            "double" => 1.1,
            "bool" => true,
            "string" => "one",
            "datetime" => new DateTime(),
            "array" => [1, "one", false]
        ],
        Encode::base64('Hello world') // PHP has no base64 object so we call it like that
    ],
    'execute'
);

echo $e;
```

Output:
```xml
<?xml version='1.0'?>
<methodCall>
  <methodName>execute</methodName>
  <params>
    <param>
      <value>
        <string>hello-world</string>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>int</name>
            <value>
              <int>1</int>
            </value>
          </member>
          <member>
            <name>double</name>
            <value>
              <double>1.100000</double>
            </value>
          </member>
          <member>
            <name>bool</name>
            <value>
              <boolean>1</boolean>
            </value>
          </member>
          <member>
            <name>string</name>
            <value>
              <string>one</string>
            </value>
          </member>
          <member>
            <name>datetime</name>
            <value>
              <dateTime.iso8601>2021-06-25T06:39:12+0000</dateTime.iso8601>
            </value>
          </member>
          <member>
            <name>array</name>
            <value>
              <array>
                <data>
                  <value>
                    <int>1</int>
                  </value>
                  <value>
                    <string>one</string>
                  </value>
                  <value>
                    <boolean>0</boolean>
                  </value>
                </data>
              </array>
            </value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <base64>SGVsbG8gd29ybGQ=</base64>
      </value>
    </param>
  </params>
</methodCall>
```

[Back To top](#Documentation)

#### As response

Request:
```php
$e = new Encode(
    [
        'hello-world',
        [
            "int" => 1,
            "double" => 1.1,
            "bool" => true,
            "string" => "one",
            "datetime" => new DateTime(),
            "array" => [1, "one", false]
        ],
        Encode::base64('Hello world')
    ],
);

echo $e;
```

Output:
```xml
<?xml version='1.0'?>
<methodResponse>
  <params>
    <param>
      <value>
        <string>hello-world</string>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>int</name>
            <value>
              <int>1</int>
            </value>
          </member>
          <member>
            <name>double</name>
            <value>
              <double>1.100000</double>
            </value>
          </member>
          <member>
            <name>bool</name>
            <value>
              <boolean>1</boolean>
            </value>
          </member>
          <member>
            <name>string</name>
            <value>
              <string>one</string>
            </value>
          </member>
          <member>
            <name>datetime</name>
            <value>
              <dateTime.iso8601>2021-06-25T06:45:04+0000</dateTime.iso8601>
            </value>
          </member>
          <member>
            <name>array</name>
            <value>
              <array>
                <data>
                  <value>
                    <int>1</int>
                  </value>
                  <value>
                    <string>one</string>
                  </value>
                  <value>
                    <boolean>0</boolean>
                  </value>
                </data>
              </array>
            </value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <base64>SGVsbG8gd29ybGQ=</base64>
      </value>
    </param>
  </params>
</methodResponse>
```

[Back To top](#Documentation)

#### As Error

Request:
```php

$f = Encode::encodeFault('Does not exist', 'no backtrace');

echo $f;

```

Output:
```xml
<?xml version='1.0'?>
<methodResponse>
  <value>
    <struct>
      <member>
        <name>faultCode</name>
        <value>
          <string>Does not exist</string>
        </value>
      </member>
      <member>
        <name>faultString</name>
        <value>
          <string>no backtrace</string>
        </value>
      </member>
    </struct>
  </value>
</methodResponse>
```

[Back To top](#Documentation)
