## Try longer repeats

1. `k = 0`; while `word · (k + 1)` occurs in `sequence`: `k += 1`.
2. Return `k`.

`"ababc"`, `"ab"` → 2. `"ababc"`, `"ba"` → 1. `"ababc"`, `"ac"` → 0.

Repeats must be consecutive copies; counting all occurrences is wrong (`"abcab"` with `"ab"` → 1). A DP over end positions gives O(n · m) if needed.

Time: O(n / m) searches of O(n · m) each, so O(n²); tiny for n ≤ 100  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
