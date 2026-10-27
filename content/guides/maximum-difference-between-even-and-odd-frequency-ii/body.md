## 20 ordered pairs

1. For each ordered pair (a, b) of different digits: prefix counts pa, pb.
2. For r = k … n: advance l while l ≤ r − k and pb[l] < pb[r], storing pa[l] − pb[l] in best[pa[l] mod 2][pb[l] mod 2].
3. Candidate (pa[r] − pb[r]) − best[1 − pa[r] mod 2][pb[r] mod 2]; answer the largest.

Examples → −1, 1, −1. Checked against every substring on 400 random strings.

Letting b have frequency 0: example 1 → 1 instead of −1.

Time: O(20 · n)  
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
