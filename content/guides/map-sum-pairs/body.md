## Push the change, not the value

Keep a map `vals` from key to its current value, and a trie where each node has a `score`.

`insert(key, val)`: `delta = val − vals.get(key, 0)`. Set `vals[key] = val`. Walk the key's path from the root, creating nodes as needed, adding `delta` to each node's `score`.

`sum(prefix)`: walk the prefix and return the final node's `score`, or 0 if the path breaks.

Do not add the full `val` again when a key is reinserted; that double-counts the old value, which is why you add the delta. A simpler O(keys · len) version scans `vals` with `startswith` for each sum, which is fine for small inputs.

Time: O(len) per operation  
Space: O(Σ len)

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
