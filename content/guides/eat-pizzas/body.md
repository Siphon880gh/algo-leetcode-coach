## Sorted descending

1. d = n / 4; take the first ⌈d / 2⌉ pizzas.
2. Then for each of the ⌊d / 2⌋ even days: skip one, take the next.
3. Fill the other slots with the smallest pizzas.

Examples → 14, 3. Checked against every split into days and day order for n = 8 on 60 random arrays.

Taking the next pizzas for even days without skipping: example 1 → 15 instead of 14.

Time: O(n log n)  
Space: O(1) besides the sort

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
