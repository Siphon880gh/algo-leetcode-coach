Given a valid JSON string, return the value it represents without using the built-in JSON.parse. Which features can appear in the input, such as whitespace or escapes, is in the official statement. For instance, {"a":[1,2,{"b":null}],"c":"x"} becomes an object with a: [1, 2, {b: null}] and c: "x". _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One value at a time

1. `value()`: skip spaces, then dispatch on the next character: { object, [ array, " string, t f n literals, otherwise a number.
2. Object: repeat key string, colon, value(), until }. Array: repeat value() until ].
3. String: copy characters to the closing quote, decoding escapes.

Constructed checks (run in Node): the example above, and 500 random values printed by JSON.stringify, match JSON.parse.

Keep object keys as strings: {"1": 2} has key "1". Handle an empty {} or [] before reading the first item.

Time: O(length)  
Space: O(depth) besides the result

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
