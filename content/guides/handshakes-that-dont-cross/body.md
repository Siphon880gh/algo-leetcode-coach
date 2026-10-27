An even number of people stand around a circle, and everyone shakes hands with exactly one other person. Return the number of ways to pair them so no two handshakes cross, modulo 10⁹ + 7. For instance, 4 people give 2 ways, 6 give 5, and 8 give 14. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Split by the first handshake

Let `dp[i]` be the answer for `2i` people. `dp[0] = 1`.

`dp[i] = Σ_{j=0}^{i−1} dp[j] · dp[i − 1 − j]` (mod `10⁹ + 7`): person 1 pairs with someone leaving `2j` people on one side and `2(i − 1 − j)` on the other.

Return `dp[n / 2]`.

The closed form `C(2i, i) / (i + 1)` needs a modular inverse; the O(n²) recurrence avoids it.

Do not pair person 1 with someone who leaves an odd number of people on one side; that group cannot all pair up without crossing. Do not forget the modulo inside the sum.

Time: O(n²)  
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
