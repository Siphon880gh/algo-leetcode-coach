## Key, then stable sort

1. `key(x)`: map each decimal digit of `x` (0 maps as the digit 0 too) and read the result as an integer.
2. Stable-sort `nums` by `key`.

Examples → `[338,38,991]`, `[123,456,789]`.

Example 1 keys 338 and 38 both map to 7, so stability keeps 338 first. Leading zeros in a mapped value simply vanish when read as an integer.

Time: O(n log n · d)  
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
