## Cancel the prefix

1. `p[0] = 0`, `p[i + 1] = p[i] ^ arr[i]`.
2. Each query `[l, r]` → `p[r + 1] ^ p[l]`.

`[1,3,4,8]` with `[[0,1],[1,2],[0,3],[3,3]]` → `[2,7,14,8]`. `[4,8,2,10]` with `[[2,3],[1,3],[0,0],[0,3]]` → `[8,0,4,4]`.

Do not recompute each range; that is O(n) per query. Do not use `p[r] ^ p[l]`; the range is inclusive.

Time: O(n + q)  
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
