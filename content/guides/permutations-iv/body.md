## Skip by blocks

1. For each position, try unused x in increasing order with parity different from the previous number.
2. w = o! · e! if the o odds and e evens left fit the forced alternation, else 0.
3. If k > w, k −= w; otherwise place x and move on.
4. If no candidate is placed, return [].

Examples → [3, 4, 1, 2], [3, 2, 1], []. Checked against listing every alternating permutation for n ≤ 7 and every k. n = 100, k = 10^15 runs instantly with Python’s big integers (or cap counts above k).

Counting completions as (numbers left)!: example 1 → [] instead of [3, 4, 1, 2].

Time: O(n²)  
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
