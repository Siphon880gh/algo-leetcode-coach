## Fix the remainder

1. Sort descending; `r = Σ mod 3`.
2. If `r ≠ 0`: remove the smallest digit `≡ r`; if none, remove the two smallest `≡ 3 − r`; if impossible, return `""`.
3. Join; if the first digit is 0, return `"0"`.

`[8,1,9]` → `"981"`. `[8,6,7,1,0]` → `"8760"`. `[1]` → `""`. `[0,0,0]` → `"0"`.

Do not remove large digits; drop the smallest that fix the remainder. Do not return `"000"`; leading zeros collapse to `"0"`.

Time: O(n log n), or O(n) with counting  
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
