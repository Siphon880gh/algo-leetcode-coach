## Contribution of each minimum

1. Monotonic stack: `L[i]` = previous index with strength `< s[i]`, `R[i]` = next index with strength `≤ s[i]` (−1 and n if none).
2. `P` = prefix sums, `PP` = prefix sums of `P`.
3. Groups `[l … r]` with `L < l ≤ i ≤ r < R` have total `(i − L) · (PP[R + 1] − PP[i + 1]) − (R − i) · (PP[i + 1] − PP[L + 1])`.
4. Sum `s[i]` times that, mod 10^9 + 7.

Examples → 44, 213. Checked against summing every subarray on 300 random arrays.

Strict on one side and non-strict on the other gives each group exactly one owner when strengths tie. Keep the subtraction non-negative under the modulus.

Time: O(n)  
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
