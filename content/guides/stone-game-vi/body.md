## Combined value order

1. Sort indices by `a[i] + b[i]` descending.
2. Alice takes even positions (adds `a[i]`), Bob odd positions (adds `b[i]`).
3. Return 1, 0 or −1 by comparing the totals.

`[1,3]`/`[2,1]` → 1. `[1,2]`/`[3,1]` → 0. `[2,4,3]`/`[1,6,7]` → −1.

Picking by your own value alone is wrong; the swing is `a + b`.

Time: O(n log n)  
Space: O(n)

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
