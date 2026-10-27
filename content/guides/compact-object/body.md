## Rebuild

1. If obj is not an object (or is null), return it.
2. Array: `obj.map(compact).filter(Boolean)`.
3. Object: copy each key whose compacted value is truthy.

Examples → [1], {b: [1]}, [5, [], [16]]. Checked in Node.

Build new arrays rather than deleting: delete leaves holes, so in Node [null, 0, false, 1] → [null, null, null, 1] when printed as JSON. An emptied array or object is truthy, so it stays, as example 3 shows.

Time: O(total size)  
Space: O(depth) besides the output

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
