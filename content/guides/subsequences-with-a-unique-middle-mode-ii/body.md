Same counting as part I: count the length-5 subsequences of nums whose middle element is the only most frequent value, modulo 10^9 + 7. This version allows a much longer array. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## O(1) per middle

This assumes the array is too long for part I’s O(n · D) loop over distinct values; check the official limits.

For middle i with value v: a copies of v among the i elements on the left, b among the R = n − 1 − i on the right; l_u and r_u are the left and right counts of value u.

1. x + y ≥ 2 copies of v picked: the same binomial products as part I.
2. Keep P1 = Σ l_u r_u, P2 = Σ l_u r_u², P3 = Σ l_u² r_u, Ql = Σ l_u², Qr = Σ r_u²; adjust them in O(1) whenever one count changes.
3. One copy on the left only: add a · [(i − a)(S² − Qr′) / 2 − (S · P1′ − P2′)], with S = R − b and primes meaning v’s own term removed. Mirror for the right with P3 and Ql.
4. Take everything mod 10^9 + 7, halving with the inverse of 2.

Constructed checks (run in code): part I’s examples → 6, 4, 0; [2, 0, 3, 1, 0, 1, 0] → 6. Checked against every 5-subsequence on 300 random arrays.

Leaving v’s own term in the sums: [2, 0, 3, 1, 0, 1, 0] → 1 instead of 6.

Time: O(n)  
Space: O(D)

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
