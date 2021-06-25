XmlRpcEncode
============

Easy way to encode XMLRPC calls

## Documentation

### Installation
installing to 
```json
"require": {
    "AntanasGa/XmlRpcEncode": "^0.1"
}
```

### Notes
* The only parced object is `DateTime`
* When specific type is required use `([type name])`
  * Example: `(float) 1`, returns `<double>1.000000</double>`. Keep in mind `float` fits XMLRPC spec as `double`

### Usage
 
Request:
```php
$e = new Encode(
    'execute',
    [
        'hello-world',
        [
            "int" => 1,
            "double" => 1.1,
            "bool" => true,
            "string" => "one",
            "datetime" => new DateTime(),
            "array" => [0, 1, 2, 3]
        ]
    ]
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
              <dateTime.iso8601>2021-06-25T02:45:08+0000</dateTime.iso8601>
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
  </params>
</methodCall>
```