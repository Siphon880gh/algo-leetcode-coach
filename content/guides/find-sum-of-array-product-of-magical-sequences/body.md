## State

1. f(i, left, carry, bits): indices from i on, left uses still to place, the carry into bit i, set bits so far.
2. For c = 0 … left: s = carry + c; add nums[i]^c · invfact[c] · f(i + 1, left − c, s >> 1, bits + (s & 1)).
3. At i = n: 1 if left = 0 and bits + popcount(carry) = k.
4. Answer m! · f(0, m, 0, 0) mod 10^9 + 7.

Examples → 991600007, 170, 28. Checked against listing every sequence on 150 small random cases.

Leaving out the m! / Π c! factor (counting index multisets, not sequences): example 2 → 85 instead of 170.

Time: O(n · m³ · k)  
Space: O(n · m² · k)

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
