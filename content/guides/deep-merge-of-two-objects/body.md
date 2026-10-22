Given two JSON-like values, return their deep merge: where both hold containers that can be combined, merge them key by key, recursively; otherwise the second value wins. How arrays and mixed types are handled, and the examples, are in the official statement. For instance, merging {a: 1, c: {x: 1}} with {b: 2, c: {y: 2}} gives {a: 1, b: 2, c: {x: 1, y: 2}}, and merging {a: 1} with {a: {z: 1}} gives {a: {z: 1}}. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Recursive merge

1. If a and b are both non-null objects of the same kind (both arrays or both plain objects), copy a; for each key of b, set it to `merge(a[k], b[k])` if a has it, else `b[k]`.
2. Otherwise return b.

Constructed checks (run in Node): the examples above → {a: 1, c: {x: 1, y: 2}, b: 2} and {a: {z: 1}}.

Object.assign is shallow: the first example → c: {y: 2} instead of {x: 1, y: 2}. Remember that typeof null is object, so test for null before recursing.

Time: O(total size)  
Space: O(total size)

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
