## Undo the operations

1. Forward: len after each step (letter +1, * max(0, len − 1), # ×2, % same). If k ≥ final len, return ".".
2. Backward with L = len after step i:
   - letter: if k = L − 1, return it.
   - #: if k ≥ L / 2, k −= L / 2.
   - %: k = L − 1 − k.
   - *: nothing (k was already in range).

Examples → a, d, ".". Checked against building the string on 3,000 random cases.

Treating k as 1-indexed: example 1 → b instead of a.

Time: O(n)  
Space: O(n)

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
