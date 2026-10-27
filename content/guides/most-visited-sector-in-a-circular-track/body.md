## Start to end

1. `s = rounds[0]`, `e = rounds[-1]`.
2. If `s ≤ e`: return `[s..e]`. Else return `[1..e] + [s..n]`.

n = 4, `[1,3,1,2]` → `[1,2]`. n = 2, `[2,1,2,1,2,1,2,1,2]` → `[2]`. n = 7, `[1,3,5,7]` → `[1..7]`.

Do not simulate every lap; intermediate rounds cancel out.

Time: O(n)  
Space: O(n) output

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
