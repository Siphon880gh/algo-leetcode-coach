## Map and merge

1. `m` = map from id to a copy of each arr1 object.
2. For each o in arr2: `m.set(o.id, Object.assign(m.get(o.id) ?? {}, o))`.
3. Return `[...m.values()].sort((a, b) => a.id − b.id)`.

Example 1 → [{id: 1, x: 1}, {id: 2, x: 9}, {id: 3, x: 5}]. Example 2: the two id 2 objects merge and arr2’s x: 10, y: 20 win → [{id: 1, x: 2, y: 3}, {id: 2, x: 10, y: 20}, {id: 3, x: 0, y: 0}]. Checked in Node.

The merge is shallow, as Example 3 shows: arr2’s whole b and v replace arr1’s, so {b: {b: 94}} merged with {b: {c: 84}} → b is {c: 84} (not {b: 94, c: 84}), while y: 48, only in arr1, is kept → [{id: 1, b: {c: 84}, v: [1, 3], y: 48}]. Remember to sort: a map keeps insertion order, so arr1 = [id 3] and arr2 = [id 1] → ids 3, 1.

Time: O(n log n)  
Space: O(n)

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
