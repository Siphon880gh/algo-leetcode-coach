Given an object or array, return a copy in which every undefined value, at any depth, is replaced with null. The exact input guarantees are in the official statement. For instance, {a: undefined, b: [1, undefined], c: {d: undefined}} becomes {a: null, b: [1, null], c: {d: null}}. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map recursively

1. If v is undefined, return null.
2. If v is a non-null object: map an array’s items, or an object’s entries, with this function.
3. Otherwise return v.

Constructed check (run in Node): the example above → {a: null, b: [1, null], c: {d: null}}.

JSON.stringify drops undefined object keys rather than writing null: {a: undefined, b: [1, undefined]} → {b: [1, null]}. Check for null before recursing, since typeof null is object.

Time: O(size)  
Space: O(size)

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
