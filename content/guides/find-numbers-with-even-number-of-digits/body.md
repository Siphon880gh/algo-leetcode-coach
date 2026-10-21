## Digit count parity

1. For each `x`, `d = len(str(x))` (or divide by 10 until 0).
2. Count `x` when `d mod 2 == 0`.

`[12,345,2,6,7896]` → 2 (12 and 7896). `[555,901,482,1771]` → 1.

Do not test `x mod 2`; that is the parity of the value, not of its length. Do not use `log10` without care; floating error can misjudge powers of 10.

Time: O(n · digits)  
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
