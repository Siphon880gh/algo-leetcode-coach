## Lazy heap

1. Init: prio[id] = p; push (−p, id).
2. updatePriority: prio[id] = p; push (−p, id). The old entry stays and goes stale.
3. pollHighest: pop until prio.get(id) = p; delete id and return it. Empty heap → −1.

Examples → [null, 2, null, 5, 9], [null, 7, 4, −1]. Checked against a plain list on 500 random operation sequences.

Breaking ties by the larger id: example 1 → [null, 5, null, 9, 2].

Time: O(log (e + q)) per call  
Space: O(e + q)

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
