## State = counts per remainder

1. `cnt[r]` = groups with size % b = r; answer starts at `cnt[0]`.
2. `go(counts, left)`: try each `r ≥ 1` with `counts[r] > 0`; gain 1 if `left == 0`; recurse with `(left + r) % b`.
3. Memoise on `counts` (`left` follows from them).

`b = 3, [1,2,3,4,5,6]` → 4. `b = 4, [1,3,2,5,2,2,1,6]` → 4.

With 30 groups and b ≤ 9 the number of count vectors stays small. Pairing r with b − r first is a common speed-up but not needed for correctness. Do not memoise on the group order; that explodes.

Time: O(states · b)  
Space: O(states)

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
