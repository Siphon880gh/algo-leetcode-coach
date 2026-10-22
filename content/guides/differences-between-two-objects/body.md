You get two deeply nested values parsed from JSON. Return an object that describes only what changed between them: for each key both contain, recurse when both values are objects or both are arrays, and report a changed value when they differ. The exact shape used to report a changed value, and how keys found in only one input and type changes are handled, are in the official statement. For instance, comparing {a: 1, b: {c: 2, d: 3}} with {a: 1, b: {c: 5, d: 3}}, the only change is at b.c. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Joint recursion

1. If both values are objects and both or neither are arrays: for each key in both, recurse; keep keys whose result is non-empty.
2. Otherwise, if they differ, report the change in the statement’s format; if equal, report nothing.

Constructed checks (run in Node): the example above changes only b.c; {x: [1, 2]} vs {x: [1, 3]} changes only x.1; equal inputs change nothing.

Check for null before recursing: typeof null is object, and Object.keys(null) throws a TypeError in Node.

Time: O(total size)  
Space: O(depth) besides the output

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
