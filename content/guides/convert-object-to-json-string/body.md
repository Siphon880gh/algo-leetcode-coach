Write your own version of JSON.stringify for values that came from JSON.parse: strings, numbers, booleans, null, arrays and plain objects, nested to any depth, without calling JSON.stringify. The output format, such as spacing and key order, is described in the official statement. For instance, an object with y = 1 and x = the string a becomes `{"y":1,"x":"a"}`, the same text JSON.stringify gives, and an array of 1, the string b, null and true becomes `[1,"b",null,true]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Type by type

1. `null` → null.
2. String → the string wrapped in double quotes.
3. Number or boolean → `String(v)`.
4. Array → `[` + each item converted, joined by commas + `]`.
5. Object → `{` + each key in Object.keys order as quoted key, colon, converted value, joined by commas + `}`.

Constructed checks (run in Node): eight values, including nested objects, empty containers and null, match JSON.stringify exactly.

Check null before typeof object, since typeof null is object. Values from JSON.parse never contain undefined or functions, so those cases do not arise.

Time: O(output length)  
Space: O(output length)

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
