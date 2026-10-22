## Greedy bits

1. For bit i = n − 1 down to 0:
   - same bit in a and b → set it in both;
   - different → set it in the smaller of a, b and clear it in the other.
2. Return `a · b mod 10^9 + 7`.

Examples → 98, 930, 12. Checked against trying every x on 2,000 random inputs with n ≤ 8.

Compare the real values, not values reduced mod 10^9 + 7: that picks the wrong side on almost all random 50-bit inputs. Always giving the 1 to a fails too: example 1 → 90 instead of 98.

Time: O(n)  
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
