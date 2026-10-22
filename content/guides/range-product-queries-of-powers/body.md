## Add exponents, not products

1. `e` = positions of the set bits of `n`, smallest first.
2. `pre[i + 1] = pre[i] + e[i]`.
3. For `[l, r]`: answer `2^(pre[r + 1] − pre[l]) mod 10^9 + 7`.

Examples → [2,4,64], [2].

The exponent sum is at most 0 + 1 + … + 29 = 435, so the exponents never overflow; only the power needs the modulus. Prefix products would need a modular inverse to divide, which the exponent form avoids.

Time: O(30 + q log 435)  
Space: O(30)

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
