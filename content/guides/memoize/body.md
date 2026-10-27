## Map by arguments

1. `cache = new Map()`.
2. Return `(...args) => { key = args.join(','); if not cached, cache.set(key, fn(...args)); return cache.get(key); }`.

Examples → [4,4,1,3,2], [2,6,2,2,6,2], [8,1]. Checked in Node, including (3, 2) and (2, 3) making two separate calls.

The inputs are integers, so a joined key is unambiguous, and (3, 2) and (2, 3) get different keys as required. Use has rather than a truthy check so a cached 0 is still found.

Time: O(arguments) per call  
Space: O(distinct calls)

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
