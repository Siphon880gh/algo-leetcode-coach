## Kept signs

1. pre = prefix sums of time.
2. f(c, p, used): if c = n − 1, 0 when used = k, else infinity.
3. Otherwise rate = pre[c + 1] − pre[p + 1]; try every next kept sign nx > c with used + (nx − c − 1) ≤ k: (position[nx] − position[c]) · rate + f(nx, c, used + nx − c − 1).
4. Answer f(0, −1, 0).

Examples → 62, 34. Checked against trying every sequence of merges on 300 random roads.

Using each kept sign’s own time instead of the merged sum: example 1 → 46 instead of 62.

Time: O(n³ · k)  
Space: O(n² · k)

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
