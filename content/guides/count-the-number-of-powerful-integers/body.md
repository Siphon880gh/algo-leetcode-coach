## Count(finish) − count(start − 1)

1. count(N): t = str(N). If len(t) < len(s), 0; if equal, 1 when t ≥ s.
2. k = len(t) − len(s). For i < k with d = t[i]: if d > limit, add (limit + 1)^(k − i) and return; else add d · (limit + 1)^(k − i − 1).
3. Finally add 1 if t[k:] ≥ s.

Examples → 5, 2, 0. Checked against testing every integer on 600 random small cases.

The free digits can be 0 … limit, including a leading 0 (a shorter number), which is why each place has limit + 1 choices. finish reaches 10^15, so counting one by one is out.

Time: O(log finish)  
Space: O(log finish)

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
