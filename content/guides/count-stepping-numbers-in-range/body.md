## Digit DP

1. `f(s)`: walk the digits with state (i, last, tight, started); before starting, a 0 keeps it unstarted; after, the next digit must differ from last by exactly 1.
2. Count the started numbers when all digits are placed.
3. Return `(f(high) − f(low) + [low is stepping]) mod 10^9 + 7`.

Examples → 10, 2. Checked against direct testing on 200 random ranges up to 3000.

f(high) − f(low) leaves out low itself: example 1 → 9 instead of 10. The numbers have up to 100 digits, so work on the strings rather than integers.

Time: O(len · 10 · 10)  
Space: O(len · 10)

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
