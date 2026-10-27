Given an object or array and a predicate, return a copy that keeps only the values passing the predicate, at every depth, and drops objects and arrays that end up empty. What to return when nothing is left is in the official statement. For instance, with the predicate x > 0, {a: 1, b: {c: 2, d: −1}, e: [−3, 4]} becomes {a: 1, b: {c: 2}, e: [4]}. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Recurse and prune

This assumes the whole result is undefined when nothing survives. Adapt the top level if the statement says otherwise.

1. Array: map children, drop removed ones; return undefined if empty.
2. Object (not null): keep keys whose child survives; return undefined if none.
3. Leaf: return it if the predicate holds, else undefined.

Constructed checks (run in Node, x > 0): the example above; {x: −1} → undefined; {a: {b: −1}, c: 1} → {c: 1}.

Check emptiness after filtering the children, or an emptied branch stays: the last check → {a: {}, c: 1}.

Time: O(size)  
Space: O(size)

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
