## Lookup table

1. For each `l`: if `s[l] = 0`, record value 0 at `[l, l]` if new and move on. Else extend `r` up to `l + 29`, building `v = 2v + s[r]`, and record `[l, r]` for `v` if new.
2. Answer each query with the entry for `first ^ second`, or `[−1, −1]`.

Examples → [[0,2],[2,3]], [[−1,−1]], [[0,0]]. Checked against scanning every substring on 300 random cases.

A value’s shortest form has no leading zeros, so its length is fixed and the first left end recorded is the smallest. Values up to 10^9 fit in 30 bits.

Time: O(30 · n + q)  
Space: O(30 · n)

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
