## Count group sizes

1. For `i` in `1..n`: `cnt[digitSum(i)] += 1`.
2. `m = max(cnt)`; return the number of sums with `cnt == m`.

`n = 13` → 4 (groups `[1,10]`, `[2,11]`, `[3,12]`, `[4,13]`). `n = 2` → 2.

Do not return the largest size itself; count the groups. `digitSum(i) = digitSum(i / 10) + i mod 10` lets you reuse earlier values.

Time: O(n log n)  
Space: O(number of sums)

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
