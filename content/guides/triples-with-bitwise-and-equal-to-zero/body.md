## Split the triple into pair + one

1. `cnt[m]` = number of ordered pairs `(i, j)` with `nums[i] & nums[j] == m`.
2. For each `k` in `nums`, add `cnt[m]` for every `m` with `m & k == 0`.

Step 2 can loop over all 65536 values of `m`, or only over the submasks of `~k & 0xFFFF`: `m = c; while True: add cnt[m]; if m == 0: break; m = (m − 1) & c`.

Triples are ordered (i, j, k may repeat and order matters), so ordered pairs are correct.

Do not loop over all n³ triples; with n = 1000 that is 10⁹. Do not forget m = 0 when walking submasks.

Time: O(n² + n · 2¹⁶)  
Space: O(2¹⁶)

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
