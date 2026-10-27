## Slide the split

1. `s = sum(cards[:k])`, `best = s`.
2. For `i` in `1..k`: `s += cards[−i] − cards[k − i]`; `best = max(best, s)`.

`[1,2,3,4,5,6,1]`, k = 3 → 12. `[2,2,2]`, k = 2 → 4. `[9,7,7,9,7,7,9]`, k = 7 → 55.

Equivalently, minimize the sum of the middle window of length `n − k`. Do not try greedy picks of the larger end; that can miss better combinations.

Time: O(k)  
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
