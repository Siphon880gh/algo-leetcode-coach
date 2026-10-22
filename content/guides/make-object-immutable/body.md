Given an object or array produced by JSON.parse, return a version that cannot be changed at any depth: setting a key on an object, setting an index on an array, or calling an array method that mutates it must throw instead. The thrown value is a string, not an Error, and its exact wording, along with the list of mutating methods, is in the official statement. Reading values works as usual. For instance, after wrapping an object with x = 5, assigning x throws and x still reads 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Proxy all the way down

1. `wrap(v)`: primitives and null are returned as is.
2. `set(t, k)`: throw the array message with the index if t is an array, else the object message with the key.
3. `get(t, k)`: if t is an array and k is a mutating method, return a function that throws the method message; else return `wrap(t[k])`.

Constructed checks (run in Node, with illustrative messages): assigning a key, an index and a nested key each throws a string, push throws, and every value still reads unchanged.

Throw the string itself, not new Error(...). Wrapping lazily in get covers any depth without walking the whole object first.

Time: O(1) per access  
Space: O(1) per access

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
