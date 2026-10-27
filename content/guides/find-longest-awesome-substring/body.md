## First occurrence of each mask

1. `first[0] = −1`; `m = 0`.
2. For each `i`: toggle bit `s[i]`; check `first[m]` and `first[m ^ (1 << d)]` for d in 0..9; update the best length.
3. Record `first[m]` if unseen.

`"3242415"` → 5. `"12345678"` → 1. `"213123"` → 6.

Do not store last occurrences; the earliest gives the longest span. An array of size 1024 is faster than a map.

Time: O(10n)  
Space: O(1024)

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
