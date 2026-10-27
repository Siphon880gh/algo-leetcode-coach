## Check(X)

1. moves = 0, carry = 0. For each i: rem = ⌈X / points[i]⌉ − carry.
2. rem > 0: moves += 2 · rem − 1 (step in, then rem − 1 round trips), carry = rem − 1.
3. rem ≤ 0: stop if i is last; else moves += 1, carry = 0.
4. Feasible if moves ≤ m (stop early once it exceeds). Binary search X in [0, min(points) · m].

Examples → 4, 2. Checked against searching every move sequence on 200 random small cases.

Counting one move per extra visit: example 1 → 6 instead of 4.

Time: O(n log(m · min(points)))  
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
