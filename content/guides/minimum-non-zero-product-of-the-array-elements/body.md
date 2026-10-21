## Push to extremes

With `mx = 2^p − 1`: answer = `mx · (mx − 1)^((mx − 1) / 2)` mod 1e9+7.

`p = 1` → 1. `p = 2` → 6. `p = 3` → 1512.

For a fixed sum, a product is smallest when values are spread to extremes; 1 is the smallest non-zero value. Reduce `mx mod p` before multiplying, but keep the exponent exact (do not reduce it mod 1e9+7). p up to 60 means the exponent is about 5.8 · 10^17, fine for binary exponentiation.

Time: O(p)  
Space: O(1)

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
