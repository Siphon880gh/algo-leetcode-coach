## Count returns to zero

1. `bal = 0`, `count = 0`.
2. For each character: `bal += 1` for R, `−1` for L; if `bal == 0`, `count += 1`.
3. Return `count`.

`"RLRRLLRLRL"` → 4. `"LLLLRRRR"` → 1.

Cutting at the first zero never hurts; the rest of the string is still balanced.

Do not count R and L totals only; the answer depends on prefixes. Do not look for fixed patterns like "RL"; pieces can be long.

Time: O(n)  
Space: O(1)

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
