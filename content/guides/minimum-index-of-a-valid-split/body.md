## Prefix count

1. `x` = the dominant element, `tot` = its count.
2. Sweep i with `c` = count of x in nums[0..i]; if `2c > i + 1` and `2(tot − c) > n − i − 1`, return i.
3. Return −1.

Examples → 2, 4, −1. Checked against testing every split on 400 random arrays.

An element dominant in both halves is more than half of each, so more than half of all: only the global dominant can work. Checking each split’s halves from scratch is O(n²).

Time: O(n)  
Space: O(n), O(1) with Boyer–Moore voting

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
