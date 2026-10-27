## Heap, then rounds

1. If multiplier = 1, return nums.
2. Heap of (value, index): while k > 0 and top · multiplier ≤ max(nums), pop, multiply, push, k −= 1.
3. Sort the heap; element t gets multiplier^(k div n + [t < k mod n]) mod 10^9 + 7.

Examples → [8, 4, 6, 5, 6], [999999307, 999999993]. Checked against exact simulation on 600 random cases.

Taking the modulo during the simulation breaks the comparisons: [118820, 625641], k = 4, multiplier = 950610 → [951479416, 167914347] instead of [841312365, 262451657].

Time: O(n log n · log(max) + n log k)  
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
