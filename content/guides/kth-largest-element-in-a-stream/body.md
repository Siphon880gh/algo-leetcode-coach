## Keep the top k, read the smallest of them

Constructor: push every number, popping whenever the size passes `k`.

`add(val)`: push `val`; if the size is now above `k`, pop the minimum. Return `heap[0]`.

The heap holds the `k` largest values seen, so its minimum is the `k`th largest overall. The input may start with `k − 1` numbers; the first `add` then fills the heap to `k`.

A small speedup: if the heap already has `k` items and `val ≤ heap[0]`, skip the push.

Do not sort the whole list on every add; that is O(n log n) per call. Do not use a max-heap of everything; finding the `k`th then takes `k` pops.

Time: O(log k) per add  
Space: O(k)

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
