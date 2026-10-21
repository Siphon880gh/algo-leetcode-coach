## Remove as soon as it appears

1. For each `ch`: push.
2. If the last `len(part)` characters equal `part`, pop them.
3. Return the stack joined.

`"daabcbaabcbc", "abc"` → `"dab"`. `"axxxxyyyyb", "xy"` → `"ab"`. Checked against repeated leftmost removal on random strings.

The simple loop `while part in s: cut the first occurrence` is O(n² / |part|)-ish and fine here. For long inputs, KMP state per stack position makes the suffix check O(1).

Time: O(n · |part|)  
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
